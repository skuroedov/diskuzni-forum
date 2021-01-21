import MyModal, {PMyModal} from "./MyModal";
import React from "react";
import ok from "../res/ok_symbol.png";

interface POkModal extends PMyModal {
    msg: React.ReactNode | string;
}

export class OkModal extends MyModal<POkModal> {
    body(): JSX.Element {
        return <>
            <img src={ok} alt="OK symbol" />
            <h3>{this.props.msg}</h3>
            </>;
    }
}