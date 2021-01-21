import React from "react";
import {Modal} from "react-bootstrap";

export interface PMyModal {
    children?: React.ReactNode;
}

export interface SMyModal {
    show: boolean;
}

export default class MyModal<P extends PMyModal = PMyModal, S extends SMyModal= SMyModal> extends React.Component<P, S> {
    constructor(props: P, state: S) {
        super(props, state);
        this.state = {
            show: true,
        } as S;
    }

    hide(): void {
        this.setState({show: false});
    }

    title(): JSX.Element { return <></> };
    body(): JSX.Element { return <></> };
    footer(): JSX.Element { return <></> };

    render() {
        return <>
            <Modal show={this.state.show} onHide={() => this.hide()}>
                <Modal.Header closeButton>
                    <Modal.Title>{this.title()}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {this.body()}
                </Modal.Body>
                <Modal.Footer>
                    {this.footer()}
                </Modal.Footer>
            </Modal>
        </>
    }
}