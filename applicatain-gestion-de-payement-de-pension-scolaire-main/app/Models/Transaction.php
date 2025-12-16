<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'cpm_trans_id',
        'amount',
        'currency',
        'status',
        'message',
        'created_at',
        'updated_at',
    ];

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function createTransaction(array $data)
    {
        return $this->create($data);
    }

    public function updateTransaction($id, array $data)
    {
        $transaction = $this->find($id);
        if ($transaction) {
            $transaction->update($data);
            return $transaction;
        }
        return null;
    }
}