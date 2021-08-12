<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
use App\Models\Command;
use App\Repositories\CommandRepository;
use Illuminate\Http\Request;
use Flash;
use PowerShell;
class CommandController extends AppBaseController
{
    /** @var  CommandRepository */
    private $commandRepository;
    public function __construct(CommandRepository $commandRepository)
    {
        $this->commandRepository = $commandRepository;
    }
    /**
     * Display a listing of the AppCommand.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
	public function index(Request $request)
    {
	    $commands = $this->commandRepository->all();
        return view('commands.index')
            ->with('commands', $commands);
    }
    /**
     * Show the form for creating a new AppCommand.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
	public function create()
    {
        return view('commands.create');
    }
    /**
     * Store a newly created AppCommand in storage.
     * @param CreateCommandRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(CreateCommandRequest $request)
    {
        $input = $request->all();
        $appCommand = $this->commandRepository->create($input);
        $appCommand->execute();
        Flash::success('App Command saved successfully.');
        return redirect(route('commands.index'));
    }
    /**
     * Display the specified AppCommand.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function show(int $id){
		$appCommand = $this->commandRepository->find($id);
        if (empty($appCommand)) {
            Flash::error('App Command not found');
            return redirect(route('commands.index'));
        }
        return view('commands.show')->with('appCommand', $appCommand);
    }
    /**
     * Show the form for editing the specified AppCommand.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function edit(int $id){
		$appCommand = $this->commandRepository->find($id);
        if (empty($appCommand)) {
            Flash::error('App Command not found');
            return redirect(route('commands.index'));
        }
        return view('commands.edit')->with('appCommand', $appCommand);
    }
    /**
     * Update the specified AppCommand in storage.
     * @param int $id
     * @param UpdateCommandRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function update(int $id, UpdateCommandRequest $request){
		$appCommand = $this->commandRepository->find($id);
        if (empty($appCommand)) {
            Flash::error('App Command not found');
            return redirect(route('commands.index'));
        }
        $appCommand = $this->commandRepository->update($request->all(), $id);
        Flash::success('App Command updated successfully.');
        return redirect(route('commands.index'));
    }
    /**
     * Remove the specified AppCommand from storage.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
	public function destroy(int $id){
		$appCommand = $this->commandRepository->find($id);
        if (empty($appCommand)) {
            Flash::error('App Command not found');
            return redirect(route('commands.index'));
        }
        $this->commandRepository->delete($id);
        Flash::success('App Command deleted successfully.');
        return redirect(route('commands.index'));
    }
    public function execute(Command $command): string{
	    $r = ['success' => 'ok'];
	    $r['command'] = $command = $command->command;
	    if(!$command){
		    $r['success'] = false;
		    $r['message'] = 'Please POST a command or script!';
	    } else{
		    $ps = new PowerShell();
		    $r['data'] = $ps->execute($command);
	    }
	    return $command;
    }
}