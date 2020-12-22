import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Nav from "./Nav"
import Form from "./home/Form"
import List from "./home/List"
import Edit from "./home/Edit"

import {
  BrowserRouter as Router,
  Switch,
  Route
} from "react-router-dom";

export default class Main extends Component {
  render() {
    return (
      <Router>
        <main>
          <Nav/>
          <Switch>
            <Route path="/home/index" exact component={List} />
            <Route path="/home/form"  component={Form} />
            <Route path="/home/edit/:id" component={Edit} />
          </Switch>
        </main>
      </Router>
    )
  }
}
// for <div id="main-home"></div>
ReactDOM.render(<Main />, document.getElementById('main-home'));