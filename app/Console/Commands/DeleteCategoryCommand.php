<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class DeleteCategoryCommand extends Command
{
    private $categoryRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //validate options
        $validator = Validator::make($this->options(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return 1;
        }

        //check category
        $id = $this->option('id');
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            $this->error('please enter a valid id');
            return 1;
        }

        //delete category
        if ($this->categoryRepository->destroy($id)) {
            $this->info('Category successfully deleted');
            return 0;
        } else {
            $this->error('an error occured while deleting');
            return 1;
        }
    }
}
