<?php

namespace App\Http\Controllers\Admin\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateOrderRequest;
use App\Models\OrderCertificate;
use App\Models\Packing;
use App\Models\PaymentType;

class CertificateController extends Controller
{
    //
    public function index()
    {
        return view('admin.certificate.index');
    }

    public function edit(OrderCertificate $certificate)
    {
        $types = arrayToSelectBox(OrderCertificate::types());
        $formats = arrayToSelectBox(OrderCertificate::formats());
        $designs = arrayToSelectBox(OrderCertificate::designs());
        $packing = Packing::toSelectBox('title', 'slug');
        $paymentTypes = PaymentType::toSelectBox();

        return view('admin.certificate.edit', [
            'certificate' => $certificate,
            'types' => $types,
            'formats' => $formats,
            'designs' => $designs,
            'packing' => $packing,
            'paymentTypes' => $paymentTypes,
        ]);
    }

    public function update(CertificateOrderRequest $request, OrderCertificate $certificate)
    {
        $certificate->fill($request->validated());
        $certificate->save();

        return redirect()->route('admin.certificate.edit', $certificate)->withFlashSuccess(__('Record Updated'));
    }
}
