import Model from 'flarum/common/Model';
export default class Export extends Model {
    file(): string;
    destroysAt(): () => Date | null | undefined;
}
