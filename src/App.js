import Navbar from "./Component/Navbar/Navbar";
import {BrowserRouter, Routes, Route} from "react-router-dom";
import Home from "./Pages/Home";
import Category from "./Pages/Category";
import Login from "./Pages/Login";
import Register from "./Pages/Register";
import Item from "./Pages/Item";
import Cart from "./Component/Cart";
import Account from "./Pages/Account";
import AllBooks from "./Pages/AllBooks";

function App() {
    return (
        <div>
            <Navbar/>
            <Cart/>
            <Routes>
                <Route path="/" element={<Home/>}/>
                <Route path="/category/:id" element={<Category/>}/>
                <Route path="/login" element={<Login/>}/>
                <Route path="/register" element={<Register/>}/>
                <Route path="/item" element={<Item/>}/>
                <Route path="/all-books" element={<AllBooks />}/>
                <Route path="/account" element={<Account />}/>
            </Routes>
        </div>
    );
}

export default App;
