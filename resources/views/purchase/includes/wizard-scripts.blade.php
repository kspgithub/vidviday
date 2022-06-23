{!! $wizard->getForm()->getWidgetExternalScript() !!}
<script type="text/javascript">
    var purchaseStatus = 0;
    var purchaseOrder = '{{$wizard->getOrderReference()}}';

    function purchaseCheck(order) {

    }

    function purchaseCallback(event) {

        if (event.data === 'WfpWidgetEventApproved') {
            // location.url = '...';
            purchaseStatus = 1;
            console.log('WfpWidgetEventApproved')
            purchaseCheck(purchaseOrder);
        }
        if (event.data === 'WfpWidgetEventDeclined') {
            // location.url = '...';
            console.log('WfpWidgetEventDeclined')
        }
        if (event.data === 'WfpWidgetEventPending') {
            // location.url = '...';
            console.log('WfpWidgetEventPending')
        }
        if (event.data === 'WfpWidgetEventClose') {
            // location.url = '...';
            console.log('WfpWidgetEventClose')
            if (purchaseStatus === 1) {
                document.location = '{{$wizard->getReturnUrl()}}';
            } else {
                document.location.reload();
            }

        }
    }

</script>
{!! $wizard->getForm()->getWidgetInitScript('purchaseCallback') !!}
