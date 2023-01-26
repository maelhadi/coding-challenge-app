<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class DeleteProductCommand extends Command
{
    private $productRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deelete a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();

        $this->productRepository = $productRepository;
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

        $id = $this->option('id');
        $product = $this->productRepository->find($id);
        if (!$product) {
            $this->error('please enter a valid id');
            return 1;
        }

        //delete product
        $this->productRepository->destroy($id);

        $this->info('Product successfully deleted');
        return 0;
    }
}
