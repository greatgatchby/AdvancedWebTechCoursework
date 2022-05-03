import {useState} from "react";

const Register = () => {
    const [values, setValues] = useState({
        "phone" : null,
        "password" : null,
        "passwordConfirm" : null,
        "firstname" : null,
        "lastname" : null,
        "address line 1" : null,
        "address line 2" : null,
        "city" : null,
        "country" : null,
        "province" : null,
        "postcode" : null,
    })
    const handlePhoneChange = (e) => {}
    return(
        <div className={'container d-flex justify-content-center align-items-center min-vh-100'}>
            <div className={'col-md-6'}>
                <h1>Register</h1>
                <div className={'card p-5 text-start'}>
                    <form>
                        <h3 className={'pt-4'}>Account Details</h3>
                        <div className={'row pt-4'}>
                            <div className={'form-group col-3'}>
                                <select className="form-select" aria-label="Default select example">
                                    <option selected value="+44">+44</option>
                                    <option value="+239">+239</option>
                                </select>
                            </div>
                            <div className={'form-group col-9'}>
                                <input className={'form-control'} placeholder={'phone number'}/>
                            </div>
                        </div>
                        <div className={'form-group pt-4'}>
                            <input className={'form-control'} type={'password'}  placeholder={'password'}/>
                        </div>
                        <div className={'form-group pt-4'}>
                            <input className={'form-control'} type={'password'}  placeholder={'confirm password'}/>
                        </div>
                        <h3 className={'pt-4'}>Personal Details</h3>
                        <div className={'form-group pt-4'}>
                            <input className={'form-control'} placeholder={'firstname'}/>
                        </div>
                        <div className={'form-group pt-4'}>
                            <input className={'form-control'} placeholder={'lastname'}/>
                        </div>
                        <h3 className={'pt-4'}>Shipping Address</h3>
                        <div className={'row'}>
                            <div className={'form-group pt-4 col-6'}>
                                <input className={'form-control col-4'} placeholder={'Address Line 1'}/>
                            </div>
                            <div className={'form-group pt-4 col-6'}>
                                <input className={'form-control col-4'} placeholder={'Address Line 2'}/>
                            </div>
                        </div>
                        <div className={'row'}>
                            <div className={'form-group pt-4 col-4'}>
                                <input className={'form-control col-4'} placeholder={'City'}/>
                            </div>
                            <div className={'form-group pt-4 col-2'}>
                                <input className={'form-control col-4'} placeholder={'Country'}/>
                            </div>
                            <div className={'form-group pt-4 col-4'}>
                                <input className={'form-control col-4'} placeholder={'Province'}/>
                            </div>
                        </div>
                        <div className={'row'}>
                            <div className={'form-group pt-4 col-3'}>
                                <input className={'form-control col-4'} placeholder={'Postcode'}/>
                            </div>
                        </div>
                        <div className={'text-center pt-4'}>
                            <button className={'btn btn-primary'} type={'Submit'}>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Register
