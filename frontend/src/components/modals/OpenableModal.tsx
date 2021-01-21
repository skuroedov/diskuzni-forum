import React from "react";
import {Modal} from "react-bootstrap";
import MyModal, {PMyModal, SMyModal} from "./MyModal";


export class OpenableModal<P extends PMyModal = PMyModal, S extends SMyModal = SMyModal> extends MyModal<P, S> {
    constructor(props: P, state: S) {
        super(props, state);
        this.state = {
            show: false,
        } as S;
    }

    render() {
        return <>
            <span onClick={() => this.setState({show: true})}>
                {this.props.children}
            </span>

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