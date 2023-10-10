/// <reference types="flarum/@types/translator-icu-rich" />
export default class ProcessErasureRequestModal extends Modal<import("flarum/common/components/Modal").IInternalModalAttrs, undefined> {
    constructor();
    oninit(vnode: any): void;
    comments: any;
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    fields(): ItemList<any>;
    onsubmit(e: any, mode: any): void;
}
import Modal from "flarum/common/components/Modal";
import ItemList from "flarum/common/utils/ItemList";
