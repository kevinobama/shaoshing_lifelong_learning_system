<?php
/* PROJECT INFO --------------------------------------------------------------------------------------------------------
   Version:   1.5.2
   Changelog: http://adaptive-images.com/changelog.txt

   Homepage:  http://adaptive-images.com
   GitHub:    https://github.com/MattWilcox/Adaptive-Images
   Twitter:   @responsiveimg

   LEGAL:
   Adaptive Images by Matt Wilcox is licensed under a Creative Commons Attribution 3.0 Unported License.

/* CONFIG ----------------------------------------------------------------------------------------------------------- */

$resolutions   = [1382, 992, 768, 480]; // the resolution break-points to use (screen widths, in pixels)
$cache_path    = 'ai-cache'; // where to store the generated re-sized images. Specify from your document root!
$jpg_quality   = 95; // the quality of any generated JPGs on a scale of 0 to 100
$sharpen       = true; // Shrinking images can blur details, perform a sharpen on re-scaled images?
$watch_cache   = true; // check that the adapted image isn't stale (ensures updated source images are re-cached)
$browser_cache = 3600; // How long the BROWSER cache should last (seconds, minutes, hours, days. 7days by default)

/* END CONFIG ----------------------------------------------------------------------------------------------------------
------------------------ Don't edit anything after this line unless you know what you're doing -------------------------
--------------------------------------------------------------------------------------------------------------------- */

/* get all of the required data from the HTTP request */
$document_root = $_SERVER['DOCUMENT_ROOT'];
$requested_uri = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
$param         = false;
if (strpos($requested_uri, ':') !== false) {
    list($requested_uri, $param) = explode(':', $requested_uri);
}
$requested_file = basename($requested_uri);
$sourceFile     = $document_root . $requested_uri;
$resolution     = false;

// does the $cache_path directory exist already?
if (!is_dir("$document_root/$cache_path") && !mkdir("$document_root/$cache_path", 0755, true) && !is_dir("$document_root/$cache_path")) { // no
    sendErrorImage("Failed to create cache directory at: $document_root/$cache_path");
}

/* helper function: Send headers and returns an image. */
function sendImage($filename, $browser_cache)
{
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (in_array($extension, ['png', 'gif', 'jpeg'], true)) {
        header('Content-Type: image/' . $extension);
    } else {
        header('Content-Type: image/jpeg');
    }
    header('Cache-Control: private, max-age=' . $browser_cache);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $browser_cache) . ' GMT');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    exit();
}

/* helper function: Create and send an image with an error message. */
function sendErrorImage($message)
{
    /* get all of the required data from the HTTP request */
    $document_root  = $_SERVER['DOCUMENT_ROOT'];
    $requested_uri  = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
    $requested_file = basename($requested_uri);
    $sourceFile     = $document_root . $requested_uri;

    $im            = imagecreatetruecolor(800, 300);
    $text_color    = imagecolorallocate($im, 233, 14, 91);
    $message_color = imagecolorallocate($im, 91, 112, 233);

    imagestring($im, 5, 5, 5, 'Adaptive Images encountered a problem:', $text_color);
    imagestring($im, 3, 5, 25, $message, $message_color);

    imagestring($im, 5, 5, 85, 'Potentially useful information:', $text_color);
    imagestring($im, 3, 5, 105, "DOCUMENT ROOT IS: $document_root", $text_color);
    imagestring($im, 3, 5, 125, "REQUESTED URI WAS: $requested_uri", $text_color);
    imagestring($im, 3, 5, 145, "REQUESTED FILE WAS: $requested_file", $text_color);
    imagestring($im, 3, 5, 165, "SOURCE FILE IS: $sourceFile", $text_color);

    header('Cache-Control: no-store');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() - 1000) . ' GMT');
    header('Content-Type: image/jpeg');
    imagejpeg($im);
    imagedestroy($im);
    exit();
}

/* sharpen images function */
function findSharp($intOrig, $intFinal)
{
    $intFinal *= 750.0 / $intOrig;
    $intA   = 52;
    $intB   = -0.27810650887573124;
    $intC   = .00047337278106508946;
    $intRes = $intA + $intB * $intFinal + $intC * $intFinal * $intFinal;
    return max(round($intRes), 0);
}

/* refreshes the cached image if it's outdated */
function refreshCache($sourceFile, $cacheFile, $param)
{
    if (file_exists($cacheFile)) {
        // not modified
        if (filemtime($cacheFile) >= filemtime($sourceFile)) {
            return $cacheFile;
        }

        // modified, clear it
        unlink($cacheFile);
    }
    return generateImage($sourceFile, $cacheFile, $param);
}

/* generates the given cache file for the given source file with the given resolution */
function generateImage($sourceFile, $cacheFile, $param)
{
    global $sharpen, $jpg_quality;

    $extension = strtolower(pathinfo($sourceFile, PATHINFO_EXTENSION));

    // Check the image dimensions
    list($width, $height) = getimagesize($sourceFile);
    $ratio = $height / $width;
    $param = strtolower($param);
    if (strpos($param, 'w') === 0) {
        $resolutionWidth = substr($param, 1);
        if ($width <= $resolutionWidth) {
            return $sourceFile;
        }
        $newWidth  = $resolutionWidth;
        $newHeight = ceil($newWidth * $ratio);
    } elseif (strpos($param, 'h') === 0) {
        $resolutionHeight = substr($param, 1);
        if ($height <= $resolutionHeight) {
            return $sourceFile;
        }
        $newHeight = $resolutionHeight;
        $newWidth  = ceil($newHeight / $ratio);
    } else {
        return $sourceFile;
    }


    $dst = imagecreatetruecolor($newWidth, $newHeight); // re-sized image

    switch ($extension) {
        case 'png':
            $src = imagecreatefrompng($sourceFile); // original image
            break;
        case 'gif':
            $src = imagecreatefromgif($sourceFile); // original image
            break;
        default:
            $src = imagecreatefromjpeg($sourceFile); // original image
            imageinterlace($dst, true); // Enable interlancing (progressive JPG, smaller size file)
            break;
    }

    if ($extension === 'png') {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
        imagefilledrectangle($dst, 0, 0, $newWidth, $newHeight, $transparent);
    }

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); // do the resize in memory
    imagedestroy($src);

    // sharpen the image?
    // NOTE: requires PHP compiled with the bundled version of GD (see http://php.net/manual/en/function.imageconvolution.php)
    if ($sharpen && function_exists('imageconvolution')) {
        $intSharpness = findSharp($width, $newWidth);
        $arrMatrix    = [
            [-1, -2, -1],
            [-2, $intSharpness + 12, -2],
            [-1, -2, -1]
        ];
        imageconvolution($dst, $arrMatrix, $intSharpness, 0);
    }

    $cacheDir = dirname($cacheFile);

    // does the directory exist already?
    if (!is_dir($cacheDir) && !mkdir($cacheDir, 0755, true) && !is_dir($cacheDir)) {
        imagedestroy($dst);
        sendErrorImage("Failed to create cache directory: $cacheDir");
    }

    if (!is_writable($cacheDir)) {
        sendErrorImage("The cache directory is not writable: $cacheDir");
    }

    // save the new file in the appropriate path, and send a version to the browser
    switch ($extension) {
        case 'png':
            $gotSaved = imagepng($dst, $cacheFile);
            break;
        case 'gif':
            $gotSaved = imagegif($dst, $cacheFile);
            break;
        default:
            $gotSaved = imagejpeg($dst, $cacheFile, $jpg_quality);
            break;
    }
    imagedestroy($dst);

    if (!$gotSaved && !file_exists($cacheFile)) {
        sendErrorImage("Failed to create image: $cacheFile");
    }

    return $cacheFile;
}

// check if the file exists at all
if (!file_exists($sourceFile)) {
    header('Status: 404 Not Found');
    exit();
}

/* check that PHP has the GD library available to use for image re-sizing */
if (!extension_loaded('gd')) { // it's not loaded
    trigger_error('You must enable the GD extension to make use of Adaptive Images', E_USER_WARNING);
    sendImage($sourceFile, $browser_cache);
}

/* if the requested URL starts with a slash, remove the slash */
if (0 === strpos($requested_uri, '/')) {
    $requested_uri = substr($requested_uri, 1);
}

/* whew might the cache file be? */
$cacheFile = $document_root . "/$cache_path/$param/" . $requested_uri;

/* Use the resolution value as a path variable and check to see if an image of the same name exists at that path */
if (file_exists($cacheFile)) { // it exists cached at that size
    if ($watch_cache) { // if cache watching is enabled, compare cache and source modified dates to ensure the cache isn't stale
        $cacheFile = refreshCache($sourceFile, $cacheFile, $param);
    }

    sendImage($cacheFile, $browser_cache);
}

/* It exists as a source file, and it doesn't exist cached - lets make one: */
$file = generateImage($sourceFile, $cacheFile, $param);
sendImage($file, $browser_cache);
