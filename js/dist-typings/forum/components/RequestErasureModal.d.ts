/// <reference types="flarum/@types/translator-icu-rich" />
import Modal from 'flarum/common/components/Modal';
import ItemList from 'flarum/common/utils/ItemList';
import Stream from 'flarum/common/utils/Stream';
import Mithril from 'mithril';
import type User from 'flarum/common/models/User';
export default class RequestErasureModal extends Modal {
    reason: Stream<string>;
    password: Stream<string>;
    user: User | null;
    oninit(vnode: Mithril.Vnode): void;
    className(): string;
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    fields(): ItemList<Mithril.Children>;
    oncancel(e: Event): void;
    data(): {
        reason: any;
        status: string;
        relationships: {
            user: User | null;
        };
    };
    onsubmit(e: Event): void;
}
