import app from 'flarum/forum/app';
import NotificationsDropdown from 'flarum/forum/components/NotificationsDropdown';

import ErasureRequestsList from './ErasureRequestsList';
import { IDropdownAttrs } from 'flarum/common/components/Dropdown';
import ErasureRequestsListState from '../states/ErasureRequestsListState';

interface ErasureRequestsDropdownAttrs extends IDropdownAttrs {
  state: ErasureRequestsListState;
}

export default class ErasureRequestsDropdown extends NotificationsDropdown<ErasureRequestsDropdownAttrs> {
  static initAttrs(attrs: ErasureRequestsDropdownAttrs) {
    attrs.label = attrs.label || app.translator.trans('flarum-gdpr.forum.erasure_requests.tooltip');
    attrs.icon = attrs.icon || 'fas fa-user-minus';

    super.initAttrs(attrs);
  }

  getMenu() {
    return (
      <div className={'Dropdown-menu ' + this.attrs.menuClassName} onclick={this.menuClick.bind(this)}>
        {this.showing ? ErasureRequestsList.component({ state: this.attrs.state }) : ''}
      </div>
    );
  }

  goToRoute() {
    m.route.set(app.route('erasure-requests'));
  }

  getUnreadCount(): number | undefined {
    if (!this.attrs.state.requestsLoaded) {
      return app.forum.attribute('erasureRequestCount');
    }

    return app.store.all('erasure-requests').length;
  }

  getNewCount() {
    return this.getUnreadCount();
  }
}
