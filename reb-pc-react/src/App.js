import "./App.css";
import Navbar from "./Component/view/Navigation/navbar.js";
import {Route} from "react-router-dom";
import Blog from "./Component/view/Blog";
import Donate from "./Component/view/donate";
import Build from "./Component/view/Build/Build";
import Product from "./Component/view/Product/product_page";
import Login from "./Component/view/LoginAndSignUp/Login";
import Signup from "./Component/view/LoginAndSignUp/SignUp";
import Home from "./../src/Component/view/HomePage/Home"
import SummeryBuild from "./Component/view/Build/SummeryBuild";
import Profile from "./Component/view/My Build/Profile";
import ProductDetail from './Component/view/Product/productDetail'
import ProductDetailContextProvider from './Component/Context/productDetailContext'

import {BuildContextProvider} from "./Component/Context/BuildContext";
import React from "react";
import {Switch} from "react-router-dom";
import PageNotfound from "./Component/view/PageNotFound";
import ProductsContextProvider from "./Component/Context/ProductsContext";
import {ShopsContextProvider} from "./Component/Context/ShopsContext";
import {UserProfileContextProvider} from './Component/Context/UserProfileContext';
function App() {

    return (
        <div className="App" style={{height: "100%"}}>
            <Switch>
                <Route exact path="/"><Navbar/><Home/></Route>
                <Route path="/blog"> <Navbar/><Blog/></Route>
                <Route path="/donate"> <Navbar/><Donate/></Route>
                <Route path="/login"><Navbar/><Login/></Route>
                <Route path="/signUp"><Navbar/><Signup/></Route>
                <Route path="/profile">
                    <Navbar/>
                    <Profile/>
                </Route>
                <Route path="/build">
                    <BuildContextProvider>
                        <Navbar/>
                        <ShopsContextProvider>
                            <Build/>
                        </ShopsContextProvider>
                    </BuildContextProvider>
                </Route>
                <Route path="/summeryBuild">
                    <BuildContextProvider>
                        <Navbar/><SummeryBuild/>
                    </BuildContextProvider>
                </Route>
                <ProductsContextProvider>
                    <ProductDetailContextProvider>
                        <Route path="/product_page">
                                
                                    <Navbar/>
                                    <Product/>
                        </Route>
                        <Route path="/productDetail">
                                    <Navbar/>
                                    <ProductDetail/>
                        </Route>
                    </ProductDetailContextProvider>
                </ProductsContextProvider>
                <Route path="*"><PageNotfound/></Route>
            </Switch>
        </div>
    );
}

export default App;
