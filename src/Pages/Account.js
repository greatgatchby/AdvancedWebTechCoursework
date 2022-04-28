import Category from "./Category";
import {Link, Route, Routes} from "react-router-dom";
import EditAccountDetails from "../Component/Account/EditAccountDetails";

const Account = () => {
    return (
        <div className={'row'}>
            <div className={'col-md-3 ms-3'}>
                <div className={'position-fixed card mt-5 w-25 overflow-hidden'}>
                    <div className={'card-header'}>
                        <h3>Account</h3>
                    </div>
                    <div className={'card-body'}>
                        <ul>
                            <Link to={'./accountDetails'}><li><a>Account</a></li></Link>
                            <li><Link to={'./orders'}>Orders</Link></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div className={'col-md-4'}>
                <Routes>
                    <Route path="/accountDetails" element={<EditAccountDetails />} />
                    <Route path="/orders" element={<Category />} />
                </Routes>
            </div>
        </div>
    )
}
export default Account
