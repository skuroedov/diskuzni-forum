import React from "react";
import {Button, Form, FormGroup} from "react-bootstrap";

import MyModal from "./MyModal";

export class LoginModal extends MyModal {
    title(): JSX.Element {
        return <>Přihlášení</>;
    }

    body(): JSX.Element {
        return <Form>
            <FormGroup>
                <Form.Label>Uživatelské jméno:</Form.Label>
                <Form.Control type="text" placeholder="Uživatelské jméno" />
            </FormGroup>
            <FormGroup>
                <Form.Label>Heslo:</Form.Label>
                <Form.Control type="password" placeholder="Heslo" />
            </FormGroup>
            <Button variant="success">Přihlásit se</Button>
        </Form>;
    }

    footer(): JSX.Element {
        return <>Nemáte účet? Zaregsitrujte se</>;
    }
}