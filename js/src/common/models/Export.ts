import Model from 'flarum/common/Model';

export default class Export extends Model {
  file() {
    return Model.attribute<string>('file').call(this);
  }

  destroysAt() {
    return Model.attribute('destroysAt', Model.transformDate);
  }
}
