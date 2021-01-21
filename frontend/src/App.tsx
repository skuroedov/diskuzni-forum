import React from "react";
import Page from "./components/Page";
import axios from "axios";
import {API_URL} from "./constants";

interface SApp {
    loggedIn: any
}

export default class App extends React.Component<{}, SApp> {
    private static instance: App;

    constructor(props: any, state: SApp) {
        super(props, state);

        App.instance = this;
        this.state = {loggedIn: false};
        App.userLoggedIn();
    }

    render() {
        return <Page/>;
    }

    public static getInstance(): App {
        return App.instance;
    }

    public static async userLoggedIn() {
        let res = axios.get(`${API_URL}/auth/loggedIn`).then((data) => {
            // @ts-ignore
            App.getInstance().setState({loggedIn: data.data.content});
        });
    }
}