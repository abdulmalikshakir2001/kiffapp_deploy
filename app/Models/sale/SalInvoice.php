<?php

namespace App\Models\sale;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalInvoiceDetail;
use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users\User;

class SalInvoice extends Model
{
    use HasFactory;
    protected $table="sal_invoices";
    protected $primaryKey="sal_invoice_id";
    protected $fillable=[
'company_id',
'supplier_id',
'sal_order_id',
'delivery_date',
'ref_num',
'sal_invoice_code',
'barcode',
'qr_code',
'qr_code_string',
'creation_date',
'creation_time',
'taxes',
'description',
'total_price',
'invoice_status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(SalInvoiceDetail::class,'sal_invoice_id','sal_invoice_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'sal_invoice_details','sal_invoice_id','product_id')->withPivot('sal_invoice_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'supplier_id','user_id');
    }
}
