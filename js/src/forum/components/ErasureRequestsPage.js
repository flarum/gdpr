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

import Page from 'flarum/components/Page';

import ErasureRequestsList from './ErasureRequestsList';

export default class ErasureRequestsPage extends Page {
  oninit(vnode) {
    super.oninit(vnode);

    app.history.push('erasure-requests');

    app.erasureRequests.load();

    this.bodyClass = 'App--ErasureRequests';
  }

  view() {
    return (
      <div className="ErasureRequestsPage">
        <ErasureRequestsList state={app.erasureRequests}></ErasureRequestsList>
      </div>
    );
  }
}
