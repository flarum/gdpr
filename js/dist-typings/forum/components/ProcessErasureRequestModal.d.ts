/// <reference types="flarum/@types/translator-icu-rich" />
import Modal, { IInternalModalAttrs } from 'flarum/common/components/Modal';
import ItemList from 'flarum/common/utils/ItemList';
import Stream from 'flarum/common/utils/Stream';
import type Mithril from 'mithril';
import ErasureRequest from 'src/common/models/ErasureRequest';
import User from 'flarum/common/models/User';
interface ProcessErasureRequestModalAttrs extends IInternalModalAttrs {
    request: ErasureRequest | undefined;
    user: User | undefined;
}
export default class ProcessErasureRequestModal extends Modal<ProcessErasureRequestModalAttrs> {
    comments: Stream<string>;
    loadingAnonymization: boolean;
    loadingDeletion: boolean;
    request: ErasureRequest;
    oninit(vnode: Mithril.Vnode<ProcessErasureRequestModalAttrs>): void;
    className(): string;
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    fields(): ItemList<Mithril.Children>;
    process(mode: string): void;
}
export {};
