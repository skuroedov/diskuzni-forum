import React, {FormEvent} from "react";
import {Alert, Button, Form, FormGroup} from "react-bootstrap";
import axios from "axios";
import {OpenableModal} from "./OpenableModal";
import {API_URL} from "../../constants";
import {PMyModal, SMyModal} from "./MyModal";
import {ErrorModal} from "./ErrorModal";


export interface SRegisterModal extends SMyModal {
    msg?: React.ReactNode;
    modals?: React.ReactNode;
}

export class RegisterModal extends OpenableModal<PMyModal, SRegisterModal> {
    constructor(props: PMyModal, state: SRegisterModal) {
        super(props, state);
        this.onSubmit = this.onSubmit.bind(this);
    }

    title(): JSX.Element {
        return <>Registrace</>;
    }

    body(): JSX.Element {
        return <Form onSubmit={this.onSubmit}>
            <FormGroup controlId="username">
                <Form.Label>Uživatelské jméno:</Form.Label>
                <Form.Control type="text" placeholder="Uživatelské jméno" required/>
            </FormGroup>
            <FormGroup controlId="email">
                <Form.Label>E-Mail:</Form.Label>
                <Form.Control type="email" placeholder="E-Mail" required/>
            </FormGroup>
            <FormGroup controlId="password">
                <Form.Label>Heslo:</Form.Label>
                <Form.Control type="password" placeholder="Heslo" required/>
            </FormGroup>
            <FormGroup controlId="passwordRepeat">
                <Form.Label>Heslo znovu:</Form.Label>
                <Form.Control type="password" placeholder="Heslo" onChange={() => this.comparePasswords()}
                              required/>
            </FormGroup>
            <div id="registerError">{this.state.msg}</div>
            <Button variant="success" type="submit">Zaregistrovat se</Button>
            {this.state.modals}
        </Form>;
    }

    private async onSubmit(e: FormEvent) {
        e.preventDefault();
        this.setState({modals: null});

        // @ts-ignore
        let username = document.getElementById("username").value;
        // @ts-ignore
        let email = document.getElementById("email").value;
        // @ts-ignore
        let password = document.getElementById("password").value;

        if (!this.comparePasswords()) return;

        const res = await axios.post(`${API_URL}/auth/register`, {
            username: username,
            password: password,
            email: email
        });

        console.log(res.data);
        if(res.data.status != 200) {
            this.setState({modals: <ErrorModal msg={res.data.msg} />})
        }
    }

    comparePasswords(): boolean {
        // @ts-ignore
        if (document.getElementById("passwordRepeat").value !== document.getElementById("password").value) {
            this.error("Hesla se neshodují");
            return false;
        } else {
            // @ts-ignore
            this.cleanError();
            return true;
        }
    }

    private error(msg: string) {
        this.setState({msg: <Alert variant="danger">{msg}</Alert>});
    }

    private cleanError() {
        this.setState({msg: ""});
    }
}