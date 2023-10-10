import app from 'flarum/forum/app';

export default class ErasureRequestsListState {
  loading: boolean = false;
  requestsLoaded: boolean = false;

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
