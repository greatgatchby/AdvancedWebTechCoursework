import React, {useState} from 'react'
import {Link} from 'react-router-dom'
import {closeNav, openNav} from "../Cart";

const Navbar = () => {
    const [loggedIn, setLoggedIn] = useState(false)
    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div className="container-fluid">
                <Link className="navbar-brand" to="./">Booky's</Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span>&#9776;</span>
                </button>
                <div className="collapse navbar-collapse" id="navbarColor01">
                    <ul className="navbar-nav me-auto">
                        <li className="nav-item dropdown">
                            <div className="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button"
                                 aria-haspopup="true" aria-expanded="false">Books
                            </div>
                            <div className="dropdown-menu">
                                <b className={'ms-2'}>School Books</b>
                                <a className="dropdown-item" href="./category?category=school_books">English</a>
                                <a className="dropdown-item" href="#">Maths</a>
                                <a className="dropdown-item" href="#">Science</a>
                                <div className="dropdown-divider"></div>
                                <b className={'ms-2'}>Fiction</b>
                                <a className="dropdown-item" href="#">New arrivals</a>
                                <a className="dropdown-item" href="#">Love</a>
                                <a className="dropdown-item" href="#">Prize winners</a>
                            </div>
                        </li>
                    </ul>
                    {loggedIn === false ? <>
                            <Link to={'./login'}>
                                <button className={'btn btn-primary ms-2'}>
                                    Login
                                </button>
                            </Link>
                            <Link to={'./register'}>
                                <button className={'btn btn-light ms-2'}>
                                    Register
                                </button>
                            </Link>

                        </> :
                        <Link to={'./account'}>
                            <button className={'btn btn-light ms-2'}>
                                Account
                            </button>
                        </Link>
                    }
                    <button className={'btn btn-outline-light ms-2'} data-bs-container="body" data-bs-toggle="popover"
                            data-bs-placement="bottom" data-bs-content="Bottom popover" onClick={openNav}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             className="bi bi-bag me-1 mb-1" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                        Cart
                    </button>
                </div>
            </div>
        </nav>
    )
}

export default Navbar;
