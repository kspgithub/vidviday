<div class="toast-container position-fixed bottom-0 end-0 p-3">
    @if(session()->get('flash_success'))
        <x-bootstrap.toast type="success">{{ session()->get('flash_success') }}</x-bootstrap.toast>
    @endif

    @if(session()->get('flash_warning'))
        <x-bootstrap.toast type="warning">{{ session()->get('flash_warning') }}</x-bootstrap.toast>
    @endif

    @if(session()->get('flash_info'))
        <x-bootstrap.toast type="info">{{ session()->get('flash_info') }}</x-bootstrap.toast>
    @endif

    @if(session()->get('flash_message'))
        <x-bootstrap.toast type="info">{{ session()->get('flash_message') }}</x-bootstrap.toast>
    @endif

    @if(session()->get('flash_danger'))
        <x-bootstrap.toast type="danger">{{ session()->get('flash_danger') }}</x-bootstrap.toast>
    @endif
</div>

