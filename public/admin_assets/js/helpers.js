
    function getAlertIconByClass(className){
        var icon='';

        switch (className){
            case'success':icon='fa fa-check';break;
            case'warning':icon='fa fa-warning';break;
            case'info':icon='fa fa-info';break;
            case'danger':icon='fa fa-ban';break;
            default:icon='fa fa-check';
        }
        return icon;
    }
    function alert_message(data) {
        var alet_box=$('#alert-message-box').html();
        alet_box=alet_box.replace('{className}',data.className);
        alet_box=alet_box.replace('{icon}',getAlertIconByClass(data.className));
        alet_box=alet_box.replace('{message}',data.message);
        $('body section.main-content').prepend(alet_box);
    }