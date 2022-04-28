import {Link} from "react-router-dom";
import React from "react";

const Item = () => {
    return (
        <div className={'container'}>
            <div className="text-start col-12 card item-card h-100 p-0 me-3 my-5">
                <div className="row">
                    <div className="col-md-6">
                        <img className={'img-fluid'} src={'https://via.placeholder.com/800'}/>
                    </div>
                    <div className="col-md-6 d-flex flex-column justify-content-center">
                        <div className={'p-3'}>
                            <h3>Book Title</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            <button className={'btn btn-dark col-md-4 rounded-pill'}>Add to Basket</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    )
}

export default Item
