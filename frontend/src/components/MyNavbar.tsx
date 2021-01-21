import React from "react";
import {Nav, Navbar} from "react-bootstrap";
import {LoginModal} from "./modals/LoginModal";
import {RegisterModal} from "./modals/RegisterModal";
import App from "../App";
import {API_URL} from "../constants";
import axios from "axios";

export class MyNavbar extends React.Component {
    render(): JSX.Element {
        return <Navbar variant="dark" bg="dark" expand="lg">
            <Navbar.Brand href="#home">Domů</Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav"/>
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="mr-auto">
                    <Nav.Link href="#">Link</Nav.Link>
                    <Nav.Link href="#">Link</Nav.Link>
                </Nav>
                <Nav className="mr-right">
                    {this.right()}
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    }

    right(): JSX.Element {
        let a = App.getInstance().state.loggedIn;
        console.log(a);
        if (a) {
            return <>
                <Nav.Link onClick={async () => {
                    axios.get(`${API_URL}/auth/logout`).then(() => {
                        window.location.reload();
                    });
                }} href="#">Odhlásit se</Nav.Link>
            </>;
        } else {
            return <>
                <LoginModal>
                    <Nav.Link href="#">Přihlásit se</Nav.Link>
                </LoginModal>
                <RegisterModal>
                    <Nav.Link href="#">Zaregistrovat se</Nav.Link>
                </RegisterModal>
            </>;
        }
    }
}