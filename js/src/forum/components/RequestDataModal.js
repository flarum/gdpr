import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class RequestDataModal extends Modal {
    className() {
        return 'RequestDataModal Modal--small';
    }

    title() {
        return app.translator.trans('blomstra-gdpr.forum.request_data.title');
    }

    content() {
        return (
            <div className="Modal-body">
                <div className="Form Form--centered">
                    <p className="helpText">{app.translator.trans('blomstra-gdpr.forum.request_data.text')}</p>
                    <div className="Form-group">
                        {Button.component({
                            className: 'Button Button--primary Button--block',
                            type: 'submit',
                            loading: this.loading,
                        }, app.translator.trans('blomstra-gdpr.forum.request_data.request_button'))}
                    </div>
                </div>
            </div>
        );
    }

    onsubmit(e) {
        e.preventDefault();

        this.loading = true;

        app
            .request({
                method: 'POST',
                url: app.forum.attribute('apiUrl') + '/gdpr/export',
            })
            .then(this.hide.bind(this), this.loaded.bind(this));
    }
}
