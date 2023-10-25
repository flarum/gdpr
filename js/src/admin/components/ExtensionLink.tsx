import LinkButton from 'flarum/common/components/LinkButton';
import { Extension } from 'flarum/admin/AdminApplication';
import app from 'flarum/admin/app';
import Component from 'flarum/common/Component';
import Tooltip from 'flarum/common/components/Tooltip';

export interface ExtensionLinkAttrs {
  extension: Extension | null;
}

export default class ExtensionLink extends Component<ExtensionLinkAttrs> {
  view() {
    const { extension } = this.attrs;

    if (!extension) {
      return null;
    }

    const iconName = extension.icon?.name;
    const backgroundColor = extension.icon?.backgroundColor || 'transparent';
    const foregroundColor = extension.icon?.color || '#000';

    return (
      <Tooltip text={extension.extra['flarum-extension'].title}>
        <LinkButton
          className="Button Button--icon"
          icon={iconName}
          href={app.route('extension', { id: extension.id })}
          style={{ backgroundColor: backgroundColor, color: foregroundColor }}
        />
      </Tooltip>
    );
  }
}
