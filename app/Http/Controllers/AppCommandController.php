<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppCommandRequest;
use App\Http\Requests\UpdateAppCommandRequest;
use App\Repositories\AppCommandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AppCommandController extends AppBaseController
{
    /** @var  AppCommandRepository */
    private $appCommandRepository;

    public function __construct(AppCommandRepository $appCommandRepo)
    {
        $this->appCommandRepository = $appCommandRepo;
    }

    /**
     * Display a listing of the AppCommand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $appCommands = $this->appCommandRepository->all();

        return view('app_commands.index')
            ->with('appCommands', $appCommands);
    }

    /**
     * Show the form for creating a new AppCommand.
     *
     * @return Response
     */
    public function create()
    {
        return view('app_commands.create');
    }

    /**
     * Store a newly created AppCommand in storage.
     *
     * @param CreateAppCommandRequest $request
     *
     * @return Response
     */
    public function store(CreateAppCommandRequest $request)
    {
        $input = $request->all();

        $appCommand = $this->appCommandRepository->create($input);

        Flash::success('App Command saved successfully.');

        return redirect(route('appCommands.index'));
    }

    /**
     * Display the specified AppCommand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appCommand = $this->appCommandRepository->find($id);

        if (empty($appCommand)) {
            Flash::error('App Command not found');

            return redirect(route('appCommands.index'));
        }

        return view('app_commands.show')->with('appCommand', $appCommand);
    }

    /**
     * Show the form for editing the specified AppCommand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appCommand = $this->appCommandRepository->find($id);

        if (empty($appCommand)) {
            Flash::error('App Command not found');

            return redirect(route('appCommands.index'));
        }

        return view('app_commands.edit')->with('appCommand', $appCommand);
    }

    /**
     * Update the specified AppCommand in storage.
     *
     * @param int $id
     * @param UpdateAppCommandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppCommandRequest $request)
    {
        $appCommand = $this->appCommandRepository->find($id);

        if (empty($appCommand)) {
            Flash::error('App Command not found');

            return redirect(route('appCommands.index'));
        }

        $appCommand = $this->appCommandRepository->update($request->all(), $id);

        Flash::success('App Command updated successfully.');

        return redirect(route('appCommands.index'));
    }

    /**
     * Remove the specified AppCommand from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appCommand = $this->appCommandRepository->find($id);

        if (empty($appCommand)) {
            Flash::error('App Command not found');

            return redirect(route('appCommands.index'));
        }

        $this->appCommandRepository->delete($id);

        Flash::success('App Command deleted successfully.');

        return redirect(route('appCommands.index'));
    }
}
