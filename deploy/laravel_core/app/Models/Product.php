<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use \App\Traits\LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity',
        'gst_percent',
        'low_stock_threshold',
        'expiry_date',
        'batch_no'
    ];

    /**
     * Deduct stock directly from the product.
     */
    public function deductStock($quantityToDeduct)
    {
        if ($this->quantity < $quantityToDeduct) {
            throw new \Exception("Insufficient stock for product: " . $this->name);
        }

        $this->decrement('quantity', $quantityToDeduct);
        
        return true;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate HTML Barcode for the product SKU.
     */
    public function getBarcodeHtml()
    {
        if (!$this->sku) return '';
        
        $generator = new BarcodeGeneratorHTML();
        return $generator->getBarcode($this->sku, $generator::TYPE_CODE_128);
    }

    protected static function boot()
    {
        parent::boot();
    }

}
