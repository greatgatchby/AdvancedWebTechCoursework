import React, {useEffect, useState} from 'react';
import {Link} from 'react-router-dom';
//import {getAllBooks} from '../ajax/book'

const itemList = [
    {
        id: "1",
        title: "The Lord of the rings: The Fellowship of the Ring",
        image: "https://upload.wikimedia.org/wikipedia/en/thumb/e/e9/First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif/220px-First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif",
        author: "J.R.R. Tolkein",
        isbn: "978-0008471293",
        description: "In a sleepy village in the Shire, a young hobbit is entrusted with an immense task. He must make a perilous journey across Middle-earth to the Cracks of Doom, there to destroy the Ruling Ring of Power - the only thing that prevents the Dark Lord Sauron’s evil dominion.\n" +
            "\n" +
            "Thus begins J. R. R. Tolkien’s classic tale of adventure, which continues in The Two Towers and The Return of the King",
        publisher: "©1954, 1966 The Tolkien Estate Limited (P)2021 HarperCollins Publishers Limited"

    },
    {
        id: "2",
        title: "The Lord of the rings: The Fellowship of the Ring",
        image: "https://upload.wikimedia.org/wikipedia/en/thumb/e/e9/First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif/220px-First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif",
        author: "J.R.R. Tolkein",
        description: "In a sleepy village in the Shire, a young hobbit is entrusted with an immense task. He must make a perilous journey across Middle-earth to the Cracks of Doom, there to destroy the Ruling Ring of Power - the only thing that prevents the Dark Lord Sauron’s evil dominion.\n" +
            "\n" +
            "Thus begins J. R. R. Tolkien’s classic tale of adventure, which continues in The Two Towers and The Return of the King",
        publisher: "©1954, 1966 The Tolkien Estate Limited (P)2021 HarperCollins Publishers Limited"

    }
]

const Item = ({title, image, description, publisher, author, isbn, id}) => {
    return (
        <div className="col-sm-6 col-md-3 p-0 m-0 px-2 py-2">
            <div className={'card item-card'}>
                <div className={'position-relative'}>
                    <div className={'card-header pb-0'}>
                        <h6>{title}</h6>
                    </div>
                    <div className={'position-relative card-img-top product-card-img-container text-center'}>
                        <img alt={''} className={'product-card-img'} src={"https://via.placeholder.com/800"}/>
                        <Link to={'/item'} className={'stretched-link'}/>
                    </div>
                    <div className={'card-body product-card-body pt-0'}>
                        <i>{isbn}</i><br/>
                        <i>{publisher}</i><br/>
                        <i>written by: {author}</i><br/>
                        <p>{description}</p>
                    </div>
                </div>
                <div className={'row p-2'}>
                    <div className={'col p-0 m-0'}>
                        <Link to={'/item'}><div className={'card-footer bg-white border-0 text-center'}>
                            <button className={'btn btn-secondary w-100 rounded-pill'}>Learn more</button>
                        </div></Link>
                    </div>
                    <div className={'col p-0 m-0'}>
                        <div className={'card-footer bg-white border-0 text-center'}>
                            <button className={'btn btn-dark w-100 rounded-pill'}>Add to Basket</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

const AllBooks = () => {
    const [books, setBooks] = useState([])

    useEffect(()=>{
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                setBooks(JSON.parse(xmlhttp.responseText).data)
            }
        }
        xmlhttp.open("GET","http://localhost/18021745/php/book");
        xmlhttp.send();
    }, [])
    return (
        <div className={'container-fluid'}>
            <div className={'container'}>
                <h1>All Books</h1>
            <div className="row">
                {books ? books.map((item, idx) => (
                    <Item key={idx} title={item.title} description={item.description} image={item.image} author={item.author_id} publisher={item.publisher} isbn={item.isbn}/>
                )): null }
            </div>
        </div>
</div>
    )
}

export default AllBooks
