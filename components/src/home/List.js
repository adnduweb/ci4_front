import React, { Component } from 'react'; 
import axios from "axios"
import { Link } from "react-router-dom";

export default class List extends React.Component {
    
    constructor(props)
    {
        super(props);
        this.state = {
            listCustomer:[],
            hasError: false
        }
    }

    static getDerivedStateFromError(error) {
        // On met à jour l’état afin que le prochain rendu affiche
        // l’UI de remplacement.
        return { hasError: true };
      }

    componentDidMount()
    {

        //this.setState({listCustomer: [{uuid:'trtdstsrtretreteztze'}]})

        axios.get("http://spreadci4.lan/api/customer/list", {headers: {'Content-Type': 'application/json'}})
        .then(response=>{
            console.log([response.data.data]);
            this.setState({listCustomer: response.data.data})
        })
        .catch(error=>{
            alert("Error ==>"+error)
        })
    }

  render() {

    //let partners = this.props && this.props.listCustomer.length > 0 ?

    if (this.state.hasError) {
        // Vous pouvez afficher ici n’importe quelle UI de secours
        return <h1>Ça sent le brûlé.</h1>;
      }


    return (
      <section>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Address</th>
              <th scope="col">Phone</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            {
              this.state.listCustomer.map((itemData)=>{
                return(
                  <tr>
                    <th scope="row">{itemData.uuid}</th>
                    <td>{itemData.username}</td>
                    <td>{itemData.email}</td>
                    <td>{itemData.fonction}</td>
                    <td>{itemData.phone}</td>
                    <td>
                      <Link class="btn btn-outline-info" to={"/customer/edit/"+itemData.uuid}>Edit</Link>
                      <a href="#" class="btn btn-danger"> Delete </a>
                    </td>
                  </tr>
                )
              })
            }
          </tbody>
        </table>
      </section>
    )
  }
}

// import React, { Component } from 'react'; 
// export default class List extends Component {
//   render() {
//     return (
//       <section>
//         <table class="table">
//           <thead class="thead-dark">
//             <tr>
//               <th scope="col">#</th>
//               <th scope="col">Name</th>
//               <th scope="col">Email</th>
//               <th scope="col">Address</th>
//               <th scope="col">Phone</th>
//               <th scope="col">Action</th>
//             </tr>
//           </thead>
//           <tbody>
//             <tr>
//               <th scope="row">1</th>
//               <td>John Doe</td>
//               <td>john@example.com</td>
//               <td>California Cll 100</td>
//               <td>3101111111</td>
//               <td>
//                 <a href="#" class="btn btn-light"> Edit </a>
//                 <a href="#" class="btn btn-danger"> Delete </a>
//               </td>
//             </tr>
//             <tr>
//               <th scope="row">2</th>
//               <td>John Doe</td>
//               <td>john@example.com</td>
//               <td>California Cll 100</td>
//               <td>3101111111</td>
//               <td>
//                 <a href="#" class="btn btn-light"> Edit </a>
//                 <a href="#" class="btn btn-danger"> Delete </a>
//               </td>
//             </tr>
//             <tr>
//               <th scope="row">3</th>
//               <td>John Doe</td>
//               <td>john@example.com</td>
//               <td>California Cll 100</td>
//               <td>3101111111</td>
//               <td>
//                 <a href="#" class="btn btn-light"> Edit </a>
//                 <a href="#" class="btn btn-danger"> Delete </a>
//               </td>
//             </tr>

//           </tbody>
//         </table>
//       </section>
//     )
//   }
// }
