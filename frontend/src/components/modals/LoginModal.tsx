import React, {FormEvent, Ref, RefObject} from "react";
import {Button, Form, FormGroup} from "react-bootstrap";

import {RegisterModal, SRegisterModal} from "./RegisterModal";
import {OpenableModal} from "./OpenableModal";
import {PMyModal} from "./MyModal";
import {API_URL} from "../../constants";
import axios from "axios";
import {ErrorModal} from "./ErrorModal";
import {OkModal} from "./OkModal";

export class LoginModal extends OpenableModal<PMyModal, SRegisterModal> {
    username: RefObject<any>;
    password: RefObject<any>;

    constructor(props: PMyModal, state: SRegisterModal) {
        super(props, state);
        this.onSubmit = this.onSubmit.bind(this);
        this.username = React.createRef();
        this.password = React.createRef();
    }

    title(): JSX.Element {
        return <>Přihlášení</>;
    }

    body(): JSX.Element {
        return <Form onSubmit={this.onSubmit}>
            <FormGroup controlId="username">
                <Form.Label>Uživatelské jméno:</Form.Label>
                <Form.Control type="text" placeholder="Uživatelské jméno" ref={this.username} />
            </FormGroup>
            <FormGroup controlId="password">
                <Form.Label>Heslo:</Form.Label>
                <Form.Control type="password" placeholder="Heslo" ref={this.password} />
            </FormGroup>
            <Button variant="success" type="submit">Přihlásit se</Button>
            {this.state.modals}
        </Form>;
    }

    footer(): JSX.Element {
        return <>Nemáte účet? <RegisterModal><a href="#">Zaregsitrujte se</a></RegisterModal></>;
    }

    private async onSubmit(e: FormEvent) {
        e.preventDefault();
        this.setState({modals: null});

        let username: string = this.username.current.value;
        let password: string = this.password.current.value;

        const res = await axios.post(`${API_URL}/auth/login`, {
            username: username,
            password: password,
        });

        if(res.data.status !== 200) {
            this.setState({modals: <ErrorModal msg={res.data.msg} />});
        } else {
            this.setState({modals: <OkModal msg={res.data.content} />});
            setTimeout(() => window.location.reload(), 3000);
        }
    }
}