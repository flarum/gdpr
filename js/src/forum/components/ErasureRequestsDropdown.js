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

import NotificationsDropdown from 'flarum/components/NotificationsDropdown';

import ErasureRequestsList from './ErasureRequestsList';

export default class ErasureRequestsDropdown extends NotificationsDropdown {
    static initAttrs(attrs) {
        attrs.label = attrs.label || app.translator.trans('blomstra-gdpr.forum.erasure_requests.tooltip');
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

    getUnreadCount() {
        if (!this.attrs.state.requestsLoaded) {
            return app.forum.attribute('erasureRequestCount');
        }

        return app.store.all('erasure-requests').length;
    }

    getNewCount() {
        return this.getUnreadCount();
    }
}
