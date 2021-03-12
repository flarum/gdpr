export default class ErasureRequestsListState {
    constructor(app) {
        this.app = app;

        this.loading = false;

        this.requestsLoaded = false;
    }

    load() {
        if (this.requestsLoaded) {
            return;
        }

        this.loading = true;
        m.redraw();

        app.store
            .find('user-erasure-requests')
            .then(
                () => (this.requestsLoaded = true),
                () => {}
            )
            .then(() => {
                this.loading = false;
                m.redraw();
            });
    }
}
