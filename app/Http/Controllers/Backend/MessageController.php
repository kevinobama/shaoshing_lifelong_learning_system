<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateMessageRequest;
use App\Http\Requests\Backend\UpdateMessageRequest;
use App\Models\MessageType;
use App\Repositories\Backend\MessageRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MessageController extends AppBaseController
{
    /** @var  MessageRepository */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->middleware('auth',['except' => 'upload']);
        $this->messageRepository = $messageRepo;
    }

    /**
     * Display a listing of the Message.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->messageRepository->pushCriteria(new RequestCriteria($request));
        $messages = $this->messageRepository->paginate(20);

        return view('backend.messages.index')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
        $types = MessageType::select('id', 'name')->get()->toArray();
        return view('backend.messages.create')->with('types', array_column($types, 'name', 'id'));
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
        $input = $request->all();
        $file  = $request->file('banner');
        if ($file !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.messages_banners');
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();

            $file->move($path, $filename);
            $input['image'] = $filepath . $filename;
        }

        $message = $this->messageRepository->create($input);

        Flash::success('Message saved successfully.');

        return redirect(route('backend.messages.index'));
    }

    /**
     * Display the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }

        return view('backend.messages.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);
        $types = MessageType::select('id', 'name')->get()->toArray();
        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }

        return view('backend.messages.edit')
            ->with('message', $message)
            ->with('types', array_column($types, 'name', 'id'));
    }

    /**
     * Update the specified Message in storage.
     *
     * @param  int $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }
        $input = $request->all();
        $file  = $request->file('banner');
        if ($file !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.messages_banners');
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();

            $file->move($path, $filename);
            $input['image'] = $filepath . $filename;
        }
        $message = $this->messageRepository->update($input, $id);

        Flash::success('Message updated successfully.');

        return redirect(route('backend.messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success('Message deleted successfully.');

        return redirect(route('backend.messages.index'));
    }

    public function upload(Request $request)
    {
        sleep(5);
        $file  = $request->file('upload');
        if ($file !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.messages_images');
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();

            $file->move($path, $filename);
            $output['uploaded'] = 1;
            $output['fileName'] = $file->getClientOriginalName();
            $output['url'] = Config::get('shaoshing_lifelong_learning_system.media_host') . $filepath . $filename;
            return $output;
        }
    }
}
