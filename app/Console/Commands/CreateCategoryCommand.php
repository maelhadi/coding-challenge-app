<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateCategoryCommand extends Command
{
    private $categoryRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {--name=} {--parentId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new category';

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
            'name' => 'required|string',
            'parentId' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return 1;
        }

        //check parent category
        $parentId = $this->option('parentId');
        $parentCategory = $this->categoryRepository->find($parentId);
        if (isset($parentId) && !$parentCategory) {
            $this->error('please enter a valid category id');
            return 1;
        }

        //create new category
        $this->categoryRepository->create([
            'name' => $this->option('name'),
            'parent_id' => $this->option('parentId'),
        ]);


        $this->info('Category successfully created');
        return 0;
    }
}
