/*
 *
 *  This file is part of fof/erasurerequests.
 *
 *  Copyright (c) 2019 FriendsOfFlarum.
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 */

import Component from 'flarum/Component';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import avatar from 'flarum/helpers/avatar';
import icon from 'flarum/helpers/icon';
import username from 'flarum/helpers/username';
import humanTime from 'flarum/helpers/humanTime';

import ProcessErasureRequestModal from './ProcessErasureRequestModal';

export default class ErasureRequestsList extends Component {
  view() {
    const erasureRequests = app.store.all('user-erasure-requests');
    const state = this.attrs.state;

    return (
      <div className="NotificationList ErasureRequestsList">
        <div className="NotificationList-header">
          <h4 className="App-titleControl App-titleControl--text">{app.translator.trans('blomstra-gdpr.forum.erasure_requests.title')}</h4>
        </div>
        <div className="NotificationList-content">
          <ul className="NotificationGroup-content">
            {erasureRequests.length ? (
              erasureRequests.map((request) => {
                return (
                  <li>
                    <a onclick={this.showModal.bind(this, request)} className="Notification Request">
                      {avatar(request.user())}
                      {icon('fas fa-user-edit', { className: 'Notification-icon' })}
                      <span className="Notification-content">
                        {app.translator.trans(`blomstra-gdpr.forum.erasure_requests.item_text`, {
                          name: username(request.user()),
                        })}
                      </span>
                      {humanTime(request.createdAt())}
                    </a>
                  </li>
                );
              })
            ) : !state.loading ? (
              <div className="NotificationList-empty">{app.translator.trans('blomstra-gdpr.forum.erasure_requests.empty_text')}</div>
            ) : (
              LoadingIndicator.component({ className: 'LoadingIndicator--block' })
            )}
          </ul>
        </div>
      </div>
    );
  }

  showModal(request) {
    app.modal.show(ProcessErasureRequestModal, { request });
  }
}
