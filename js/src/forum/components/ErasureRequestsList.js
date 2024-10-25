import app from 'flarum/forum/app';
import Component from 'flarum/common/Component';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import Avatar from 'flarum/common/components/Avatar';
import username from 'flarum/common/helpers/username';
import HeaderListItem from 'flarum/forum/components/HeaderListItem';

import ProcessErasureRequestModal from './ProcessErasureRequestModal';

export default class ErasureRequestsList extends Component {
  view() {
    const erasureRequests = app.store.all('user-erasure-requests');
    const state = this.attrs.state;

    return (
      <div className="HeaderList ErasureRequestsList">
        <div className="NotificationList-header">
          <h4 className="App-titleControl App-titleControl--text">{app.translator.trans('blomstra-gdpr.forum.erasure_requests.title')}</h4>
        </div>
        <div className="NotificationList-content">
          <ul className="HeaderListGroup-content">
            {erasureRequests.length ? (
              erasureRequests.map((request, index) => {
                return (
                  <HeaderListItem
                    key={index}
                    className="EraseRequest"
                    onclick={this.showModal.bind(this, request)}
                    avatar={<Avatar user={request.user()} />}
                    icon="fas fa-user-edit"
                    content={app.translator.trans(`blomstra-gdpr.forum.erasure_requests.item_text`, {
                      name: username(request.user()),
                    })}
                    datetim={request.createdAt()}
                  />
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
