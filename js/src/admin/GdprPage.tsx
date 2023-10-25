import app from 'flarum/admin/app';
import AdminPage, { AdminHeaderAttrs } from 'flarum/admin/components/AdminPage';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import type { IPageAttrs } from 'flarum/common/components/Page';
import type Mithril from 'mithril';

export default class GdprPage<CustomAttrs extends IPageAttrs = IPageAttrs> extends AdminPage<CustomAttrs> {
  headerInfo(): AdminHeaderAttrs {
    return {
      className: 'GdprPage',
      icon: 'fas fa-user-shield',
      title: app.translator.trans('blomstra-gdpr.admin.gdpr.title'),
      description: app.translator.trans('blomstra-gdpr.admin.gdpr.description'),
    };
  }

  content(): Mithril.Children {
    if (this.loading) {
      return <LoadingIndicator />;
    }

    return <div className="container">gdpr page</div>;
  }
}
