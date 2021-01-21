import MyModal, {PMyModal} from "./MyModal";
import React from "react";
import error from "../../res/error_symbol.png";

interface PErrorModal extends PMyModal {
    msg: React.ReactNode | string;
}

export class ErrorModal extends MyModal<PErrorModal> {
    body(): JSX.Element {
        return <>
            <img src={error} alt="Error symbol" style={{maxWidth: "100%"}} />
            <h4>{this.props.msg}</h4>
        </>;
    }
}