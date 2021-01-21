import React from "react";
import {Button, Form, FormGroup} from "react-bootstrap";

import {RegisterModal} from "./RegisterModal";
import {OpenableModal} from "./OpenableModal";

export class LoginModal extends OpenableModal {
    title(): JSX.Element {
        return <>Přihlášení</>;
    }

    body(): JSX.Element {
        return <Form onSubmit={console.log}>
            <FormGroup>
                <Form.Label>Uživatelské jméno:</Form.Label>
                <Form.Control type="text" placeholder="Uživatelské jméno" />
            </FormGroup>
            <FormGroup>
                <Form.Label>Heslo:</Form.Label>
                <Form.Control type="password" placeholder="Heslo" />
            </FormGroup>
            <Button variant="success" type="submit">Přihlásit se</Button>
        </Form>;
    }

    footer(): JSX.Element {
        return <>Nemáte účet? <RegisterModal><a href="#">Zaregsitrujte se</a></RegisterModal></>;
    }
}