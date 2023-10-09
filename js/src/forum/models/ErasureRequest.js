import Model from 'flarum/common/Model';

export default class ErasureRequest extends Model {}

Object.assign(ErasureRequest.prototype, {
  status: Model.attribute('status'),
  reason: Model.attribute('reason'),
  createdAt: Model.attribute('createdAt', Model.transformDate),
  userConfirmedAt: Model.attribute('userConfirmedAt', Model.transformDate),
  processedAt: Model.attribute('processedAt', Model.transformDate),
  processorComment: Model.attribute('processorComment'),

  user: Model.hasOne('user'),
  processedBy: Model.hasOne('processedBy'),
});
