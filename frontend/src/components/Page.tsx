import React from "react";

import {MyNavbar} from "./MyNavbar";

export default class Page extends React.Component {
    render() {
        return <div>
            {/* Header */}
            <MyNavbar />

            {/* Content */}
            <div className="container">
                {this.props.children}
            </div>

            {/* Footer */}
        </div>
    }
}
