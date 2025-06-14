<?php

namespace App\Livewire;

use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminCouponManager extends Component
{
    public ?int $editingId = null;
    public string $code = '';
    public string $type = 'fixed';
    public $value = 0;
    public ?string $expires_at = null;
    public ?int $usage_limit = null;

    protected function rules(): array
    {
        return [
            'code' => 'required|unique:coupons,code,' . $this->editingId,
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|gt:0',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
        ];
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['user_id'] = Auth::id();

        Coupon::updateOrCreate(['id' => $this->editingId], $data);

        session()->flash('status', $this->editingId ? 'Coupon updated.' : 'Coupon created.');

        $this->reset(['editingId', 'code', 'type', 'value', 'expires_at', 'usage_limit']);
        $this->type = 'fixed';
    }

    public function edit(int $id): void
    {
        $coupon = Coupon::findOrFail($id);
        $this->editingId = $coupon->id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->expires_at = optional($coupon->expires_at)->format('Y-m-d');
        $this->usage_limit = $coupon->usage_limit;
    }

    public function delete(int $id): void
    {
        Coupon::where('id', $id)->delete();
    }

    public function render()
    {
        $query = Coupon::query();
        if (Auth::user()?->role === 'seller') {
            $query->where('user_id', Auth::id());
        }

        $layout = Auth::user()?->role === 'admin' ? 'layouts.admin' : 'components.layouts.market';

        return view('admin.coupons', [
            'coupons' => $query->latest()->get(),
        ])->layout($layout);
    }
}
