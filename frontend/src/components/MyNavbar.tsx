import React from "react";
import {Nav, Navbar} from "react-bootstrap";
import {LoginModal} from "./LoginModal";

export class MyNavbar extends React.Component {
    render(): JSX.Element {
        return <Navbar variant="dark" bg="dark" expand="lg">
            <Navbar.Brand href="#home">Domů</Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="mr-auto">
                    <Nav.Link href="#">Link</Nav.Link>
                    <Nav.Link href="#">Link</Nav.Link>
                </Nav>
                <Nav className="mr-right">
                    <LoginModal>
                        <Nav.Link href="#">Přihlásit se</Nav.Link>
                    </LoginModal>
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    }
}