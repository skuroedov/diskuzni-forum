import React from "react";
import {Modal} from "react-bootstrap";

interface PMyModal {
    children: React.ReactNode;
}

interface SMyModal {
    show: boolean;
}

export default class MyModal extends React.Component<PMyModal, SMyModal> {
    constructor(props: PMyModal) {
        super(props);
        this.state = {
            show: false,
        }
    }

    hide(): void {
        this.setState({show: false});
    }

    title(): JSX.Element { return <></> };
    body(): JSX.Element { return <></> };
    footer(): JSX.Element { return <></> };

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