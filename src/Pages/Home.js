import React, {useEffect, useState} from 'react'
import {Link} from "react-router-dom";

const categories = [
    {
        name: "school books",
        image: "https://images.pexels.com/photos/374918/pexels-photo-374918.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        id: 1,
        display_on_homepage: true
    },
    {
        name: "Fiction books",
        image: "https://images.pexels.com/photos/3359734/pexels-photo-3359734.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        id: 3,
        display_on_homepage: true
    },
    {
        name: "English Books",
        image: "https://images.pexels.com/photos/3359734/pexels-photo-3359734.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        id: 3,
        display_on_homepage: false,
    }
]

const Home = () =>{
    const [categoryList,setCategoryList] = useState([])
    useEffect(() => {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                setCategoryList(JSON.parse(xmlhttp.responseText).data)
            }
        }
        xmlhttp.open("GET","http://localhost/18021745/php/category");
        xmlhttp.send();
    },[])
        return (
            <div className="container min-vh-100 text-light">
                <div className="position-relative row d-flex justify-content-center px-2 h-50  mb-3 mt-4">
                    <div className="col-sm card home-page-nav-img-container p-0 overflow-hidden">
                        <img className="card-img home-page-nav-img" src="https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Card image" />
                        <div className={'d-flex align-items-center card-img-overlay'}>
                            <h1>All Books</h1>
                        </div>
                    </div>
                    <Link to={'/all-books'} className={'stretched-link'} />
                </div>
                <div className="row d-flex justify-content-center min-vh-40">
                    {categoryList.map((category) =>
                        category.display_on_homepage ? (<div key={category.id} className="col-sm-6 mb-3">
                            <div className={"card home-page-nav-img-container p-0 overflow-hidden"}>
                                <img className="card-img home-page-nav-img" src={category.image} alt="Card image" />
                                <div className="card-img-overlay">
                                    <h1>{category.name}</h1>
                                </div>
                                <Link to={'/category/' + category.id} className={'stretched-link'}/>
                            </div>
                        </div>) : null
                    )}
                </div>
            </div>
        )
}

export default Home
