import React, {useState} from "react";

export function openNav() {
    document.getElementById("mySidenav").style.width = "450px";
}

/* Set the width of the side navigation to 0 */
export function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

const Cart = () => {
    const [cartShow, setCartShow] = useState(true);
    return (
        <>
            <div id="mySidenav" className="sidenav mt-5 text-center text-center bg-dark text-light">
                <span className="closebtn" onClick={closeNav}>&times;</span>
                    <h2 className={'text-center'}>Cart</h2>
                <div className={'card-body'}>
                    <table className="table table-light align-items-center">
                        <tbody>
                        <tr>
                            <td>
                                <img height={50} src={'https://via.placeholder.com/100x100'} />
                            </td>
                            <td>A series of unfortunate events</td>
                            <td>£14.99</td>
                            <td><input className={'w-50'} placeholder={1} type={'number'} /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div className={'card-footer'}>
                    <h2>Total: £15.27</h2>
                    <button className="btn btn-primary rounded-pill col-4 me-2">Checkout</button>
                </div>
            </div>
        </>
    )
}

export default Cart
