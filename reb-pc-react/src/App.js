import "./App.css";
import Navbar from "./Component/view/Navigation/navbar.js";
import {BrowserRouter, Route, Router, useLocation} from "react-router-dom";
import Blog from "./Component/view/Blog";
import Donate from "./Component/view/donate";
import Build from "./Component/view/Build/Build";
import Product from "./Component/view/Product/product_page";
import Login from "./Component/view/LoginAndSignUp/Login";
import Signup from "./Component/view/LoginAndSignUp/SignUp";
import Home from "./../src/Component/view/HomePage/Home"
import AuthContextProvider from "./Component/Context/AuthContext";
import PreBuildContextProvider from "./Component/Context/PreBuildContext";
import SummeryBuild from "./Component/view/Build/SummeryBuild";
import Profile from "./Component/view/My Build/Profile";
import {BuildContextProvider} from "./Component/Context/BuildContext";
import React from "react";
import { createBrowserHistory } from "history";
import * as url from "url";

function App() {
    let path = useLocation();
    let background;
    if (path.pathname === '/') {
        background = {backgroundColor: 'white'}
    }else{
        background = {backgroundImage: `url("https://www.turn-on.de/media/cache/article_images/media/cms/2019/09/intel-amd-motherboard-mainboard-prozessor-chip.jpg?7631")`}

    }

    const history = createBrowserHistory();

    return (
        <div className="App" style={{height: "100% " +" " + background}}>
            <Router history={history}>
                <AuthContextProvider>
                    <Navbar/>
                </AuthContextProvider>
                <Route path="/" exact component={Home}/>
                <Route path="/Blog" component={Blog}/>
                <Route path="/donate" component={Donate}/>
                <PreBuildContextProvider>
                    <Route path="/product_page" component={Product}/>
                </PreBuildContextProvider>
                <BuildContextProvider>
                    <Route path="/buildPC" component={Build}/>
                    <Route path="/summeryBuild" component={SummeryBuild}/>
                </BuildContextProvider>
                <Route path="/Login" component={Login}/>
                <Route path="/SignUp" component={Signup}/>
                <Route path="/profile" component={Profile}/>
            </Router>
        </div>
    );

}

export default App;
