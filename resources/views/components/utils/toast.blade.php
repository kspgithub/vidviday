@props([
    'type'=>'info',
])

<div x-data="{toast: null}" x-init="
    toast = new bootstrap.Toast($refs.toast);
    toast.show();
    $refs.toast.addEventListener('hidden.bs.toast', function () {
      $refs.toast.parentElement.remove();
    })
">
    <div class="toast align-items-center text-white bg-{{$type}} border-0 " x-ref="toast">
        <div class="d-flex">
            <div class="toast-body">
                {{ $slot }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>

