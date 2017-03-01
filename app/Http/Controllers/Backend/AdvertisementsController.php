<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateAdvertisementsRequest;
use App\Http\Requests\Backend\UpdateAdvertisementsRequest;
use App\Repositories\Backend\AdvertisementsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Config;
use Log;

class AdvertisementsController extends AppBaseController
{
    /** @var  AdvertisementsRepository */
    private $advertisementsRepository;

    public function __construct(AdvertisementsRepository $advertisementsRepo)
    {
        $this->advertisementsRepository = $advertisementsRepo;
    }

    /**
     * Display a listing of the Advertisements.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->advertisementsRepository->pushCriteria(new RequestCriteria($request));
        $advertisements = $this->advertisementsRepository->all();

        return view('backend.advertisements.index')
            ->with('advertisements', $advertisements);
    }

    /**
     * Show the form for creating a new Advertisements.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.advertisements.create');
    }

    /**
     * Store a newly created Advertisements in storage.
     *
     * @param CreateAdvertisementsRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvertisementsRequest $request)
    {
        $input = $request->all();
        
        // Upload Location and initialization
        $adImageLocation = Config::get('shaoshing_lifelong_learning_system.uploads.advertisements_images_folder');
        $createTime = time();
        $adImageUrl = null;
        $adImageName = null;
        // Move the file and save to the database
        try {
            if ($request->file('image_link')) {
                $adImageName = "image_link_".$createTime.'.'.$request->image_link->getClientOriginalExtension();
                $path = Config::get('shaoshing_lifelong_learning_system.media_path');
                $request->image_link->move($path . $adImageLocation, $adImageName);
                $adImageUrl = $adImageLocation."/".$adImageName;
                $input = array_merge($input, array('image_link' => $adImageUrl));
                $users = $this->advertisementsRepository->create($input);
                Flash::success('Advertisements saved successfully.');
            }
        } catch (\Exception $e) {
            Flash::error("Advertisement saving failed with the message: ".$e->getMessage());
            Log::info(array('log_content'=> "Advertisement saving failed with the message: ".$e->getMessage()));
        }
        
        return redirect(route('backend.advertisements.index'));
    }

    /**
     * Display the specified Advertisements.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $advertisements = $this->advertisementsRepository->findWithoutFail($id);

        if (empty($advertisements)) {
            Flash::error('Advertisements not found');

            return redirect(route('backend.advertisements.index'));
        }

        return view('backend.advertisements.show')->with('advertisements', $advertisements);
    }

    /**
     * Show the form for editing the specified Advertisements.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $advertisements = $this->advertisementsRepository->findWithoutFail($id);

        if (empty($advertisements)) {
            Flash::error('Advertisements not found');

            return redirect(route('backend.advertisements.index'));
        }

        return view('backend.advertisements.edit')->with('advertisements', $advertisements);
    }

    /**
     * Update the specified Advertisements in storage.
     *
     * @param  int              $id
     * @param UpdateAdvertisementsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvertisementsRequest $request)
    {
        $input   = $request->all();
        $advertisements = $this->advertisementsRepository->findWithoutFail($id);
        
        if (empty($advertisements)) {
            Flash::error('Advertisements not found');

            return redirect(route('backend.advertisements.index'));
        }
        
        // Upload Location and initialization
        $adImageLocation = Config::get('shaoshing_lifelong_learning_system.uploads.advertisements_images_folder');
        $createTime = time();
        $adImageUrl = null;
        $adImageName = null;
        
        // For Advertisements with updates image
        try {
            if ($request->file('image_link')) {
                $adImageName = "image_link_".$createTime.'.'.$request->image_link->getClientOriginalExtension();
                $path = Config::get('shaoshing_lifelong_learning_system.media_path');
                $request->image_link->move($path . $adImageLocation, $adImageName);
                $adImageUrl = $adImageLocation."/".$adImageName;
                $input = array_merge($input, array('image_link' => $adImageUrl));
                $advertisements = $this->advertisementsRepository->update($input, $id);
                Flash::success('Advertisements updated successfully.');
            }
        } catch (Exception $ex) {
            Flash::error('Advertisements not updated successfully.');
            Log::info(array('log_content'=> "Advertisement update failed with the message: ".$e->getMessage()));
        }
        
        return redirect(route('backend.advertisements.index'));
    }

    /**
     * Remove the specified Advertisements from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $advertisements = $this->advertisementsRepository->findWithoutFail($id);

        if (empty($advertisements)) {
            Flash::error('Advertisements not found');

            return redirect(route('backend.advertisements.index'));
        }

        $this->advertisementsRepository->delete($id);

        Flash::success('Advertisements deleted successfully.');

        return redirect(route('backend.advertisements.index'));
    }
}
